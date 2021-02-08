using Microsoft.Data.SqlClient;
using Microsoft.EntityFrameworkCore;
using System;
using System.Threading.Tasks;

#nullable disable

namespace Auth.Models
{
    public partial class COMP2001_MBrutyContext : DbContext
    {
        public COMP2001_MBrutyContext()
        {
        }

        public COMP2001_MBrutyContext(DbContextOptions<COMP2001_MBrutyContext> options)
            : base(options)
        {
        }

        public virtual DbSet<Password> Passwords { get; set; }
        public virtual DbSet<Session> Sessions { get; set; }
        public virtual DbSet<SessionCount> SessionCounts { get; set; }
        public virtual DbSet<User> Users { get; set; }

        public async Task<Boolean> Validate(User user)
        {
            int result = await Database.ExecuteSqlRawAsync("EXECUTE ValidateUser @email, @password",
                    new SqlParameter("@email", user.Email),
                    new SqlParameter("@password", user.Password)
                );
            return result == 1;
        }

        // In the spec, this is set to return void.
        // This isn't possible in asyncronous programming
        // Returning Task is the same as returning void
        public async Task Update(User user, int id)
        {
            SqlParameter firstName = new SqlParameter { ParameterName = "@first_name", Value = user.FirstName, IsNullable = true };
            if (user.FirstName == null)
            {
                firstName.Value = DBNull.Value;
            }
            SqlParameter lastName = new SqlParameter { ParameterName = "@last_name", Value = user.LastName, IsNullable = true };
            if (user.LastName == null)
            {
                lastName.Value = DBNull.Value;
            }
            SqlParameter password = new SqlParameter { ParameterName = "@password", Value = user.Password, IsNullable = true };
            if (user.Password == null)
            {
                password.Value = DBNull.Value;
            }
            SqlParameter email = new SqlParameter { ParameterName = "@email", Value = user.Email, IsNullable = true };
            if (user.Email == null)
            {
                email.Value = DBNull.Value;
            }
            await Database.ExecuteSqlRawAsync("EXECUTE UpdateUser @first_name, @last_name, @email, @password, @id",
                firstName,
                lastName,
                password,
                email,
                new SqlParameter("@id", id)
            );
            return;
        }

        // Async task's cannot have out or ref perameters
        // I have to alter the spec and return the string rather than using out
        public async Task<string> Register(User user)
        {
            var param = new SqlParameter { ParameterName = "@response", Direction = System.Data.ParameterDirection.Output };
            await Database.ExecuteSqlRawAsync("EXECUTE Register @first_name, @last_name, @password, @email, @response OUTPUT",
                new SqlParameter("@first_name", user.FirstName),
                new SqlParameter("@last_name", user.LastName),
                new SqlParameter("@password", user.Password),
                new SqlParameter("@email", user.Email),
                param
            );
            return param.Value.ToString();
        }

        public async Task Delete(int id)
        {
            await Database.ExecuteSqlRawAsync("EXECUTE DeleteUser @id",
                new SqlParameter("@id", id)
            );
            return;
        }

        protected override void OnConfiguring(DbContextOptionsBuilder optionsBuilder)
        {
            if (!optionsBuilder.IsConfigured)
            {
#warning To protect potentially sensitive information in your connection string, you should move it out of source code. You can avoid scaffolding the connection string by using the Name= syntax to read it from configuration - see https://go.microsoft.com/fwlink/?linkid=2131148. For more guidance on storing connection strings, see http://go.microsoft.com/fwlink/?LinkId=723263.
                optionsBuilder.UseSqlServer("Server=socem1.uopnet.plymouth.ac.uk;Database=COMP2001_MBruty;User Id=MBruty;Password=KrgN727+");
            }
        }

        protected override void OnModelCreating(ModelBuilder modelBuilder)
        {
            modelBuilder.HasAnnotation("Relational:Collation", "Latin1_General_CI_AS");

            modelBuilder.Entity<Password>(entity =>
            {
                entity.Property(e => e.PasswordId).HasColumnName("password_id");

                entity.Property(e => e.ChangedAt)
                    .HasColumnType("datetime")
                    .HasColumnName("changed_at")
                    .HasDefaultValueSql("(getdate())");

                entity.Property(e => e.Password1)
                    .HasMaxLength(8000)
                    .HasColumnName("password");

                entity.Property(e => e.UserId).HasColumnName("user_id");

                entity.HasOne(d => d.User)
                    .WithMany(p => p.Passwords)
                    .HasForeignKey(d => d.UserId)
                    .HasConstraintName("FK__Passwords__user___18EBB532");
            });

            modelBuilder.Entity<Session>(entity =>
            {
                entity.Property(e => e.SessionId).HasColumnName("session_id");

                entity.Property(e => e.IssuedAt)
                    .HasColumnType("datetime")
                    .HasColumnName("issued_at")
                    .HasDefaultValueSql("(getdate())");

                entity.Property(e => e.UserId).HasColumnName("user_id");

                entity.HasOne(d => d.User)
                    .WithMany(p => p.Sessions)
                    .HasForeignKey(d => d.UserId)
                    .HasConstraintName("FK__Sessions__user_i__1CBC4616");
            });

            modelBuilder.Entity<SessionCount>(entity =>
            {
                entity.HasNoKey();

                entity.ToView("SessionCount");

                entity.Property(e => e.LoginCount).HasColumnName("login_count");

                entity.Property(e => e.UserId).HasColumnName("user_id");
            });

            modelBuilder.Entity<User>(entity =>
            {
                entity.HasIndex(e => e.Email, "UQ__Users__AB6E6164CC8026C6")
                    .IsUnique();

                entity.Property(e => e.UserId).HasColumnName("user_id");

                entity.Property(e => e.Email)
                    .HasMaxLength(50)
                    .HasColumnName("email");

                entity.Property(e => e.FirstName)
                    .HasMaxLength(50)
                    .HasColumnName("first_name");

                entity.Property(e => e.LastName)
                    .HasMaxLength(50)
                    .HasColumnName("last_name");

                entity.Property(e => e.Password)
                    .HasMaxLength(8000)
                    .HasColumnName("password");
            });

            OnModelCreatingPartial(modelBuilder);
        }

        partial void OnModelCreatingPartial(ModelBuilder modelBuilder);
    }
}