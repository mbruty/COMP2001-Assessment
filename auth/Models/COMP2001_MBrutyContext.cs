using System;
using Microsoft.EntityFrameworkCore;
using Microsoft.EntityFrameworkCore.Metadata;

#nullable disable

namespace auth.Models
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

        public virtual DbSet<CwPassword> CwPasswords { get; set; }
        public virtual DbSet<CwSession> CwSessions { get; set; }
        public virtual DbSet<CwUser> CwUsers { get; set; }

        protected override void OnConfiguring(DbContextOptionsBuilder optionsBuilder)
        {
            if (!optionsBuilder.IsConfigured)
            {
#warning To protect potentially sensitive information in your connection string, you should move it out of source code. You can avoid scaffolding the connection string by using the Name= syntax to read it from configuration - see https://go.microsoft.com/fwlink/?linkid=2131148. For more guidance on storing connection strings, see http://go.microsoft.com/fwlink/?LinkId=723263.
                optionsBuilder.UseSqlServer("Server=socem1.uopnet.plymouth.ac.uk;Database=COMP2001_MBruty;User Id=MBruty;Password=KrgN727+;");
            }
        }

        protected override void OnModelCreating(ModelBuilder modelBuilder)
        {
            modelBuilder.HasAnnotation("Relational:Collation", "Latin1_General_CI_AS");

            modelBuilder.Entity<CwPassword>(entity =>
            {
                entity.HasKey(e => e.PwdId)
                    .HasName("PK__cw_Passw__7ED498FF78BB2B9C");

                entity.ToTable("cw_Passwords");

                entity.Property(e => e.PwdId).HasColumnName("pwdID");

                entity.Property(e => e.ChangedAt)
                    .HasColumnType("datetime")
                    .HasColumnName("changedAt");

                entity.Property(e => e.Pwd)
                    .HasMaxLength(110)
                    .IsUnicode(false)
                    .HasColumnName("pwd");

                entity.Property(e => e.UserId).HasColumnName("userID");

                entity.HasOne(d => d.User)
                    .WithMany(p => p.CwPasswords)
                    .HasForeignKey(d => d.UserId)
                    .HasConstraintName("FK__cw_Passwo__userI__0D7A0286");
            });

            modelBuilder.Entity<CwSession>(entity =>
            {
                entity.HasKey(e => e.SessionId)
                    .HasName("PK__cw_Sessi__23DB12CB0D0789C8");

                entity.ToTable("cw_Sessions");

                entity.Property(e => e.SessionId).HasColumnName("sessionID");

                entity.Property(e => e.AuthToken)
                    .HasMaxLength(110)
                    .IsUnicode(false)
                    .HasColumnName("authToken");

                entity.Property(e => e.IssuedAd)
                    .HasColumnType("datetime")
                    .HasColumnName("issuedAd");

                entity.Property(e => e.UserId).HasColumnName("userID");

                entity.HasOne(d => d.User)
                    .WithMany(p => p.CwSessions)
                    .HasForeignKey(d => d.UserId)
                    .HasConstraintName("FK__cw_Sessio__userI__10566F31");
            });

            modelBuilder.Entity<CwUser>(entity =>
            {
                entity.HasKey(e => e.UserId)
                    .HasName("PK__cw_Users__CB9A1CDF47E9F5F9");

                entity.ToTable("cw_Users");

                entity.Property(e => e.UserId).HasColumnName("userID");

                entity.Property(e => e.Email)
                    .IsRequired()
                    .HasMaxLength(30)
                    .IsUnicode(false)
                    .HasColumnName("email");

                entity.Property(e => e.FirstName)
                    .IsRequired()
                    .HasMaxLength(30)
                    .IsUnicode(false)
                    .HasColumnName("firstName");

                entity.Property(e => e.LastName)
                    .IsRequired()
                    .HasMaxLength(30)
                    .IsUnicode(false)
                    .HasColumnName("lastName");
            });

            OnModelCreatingPartial(modelBuilder);
        }

        partial void OnModelCreatingPartial(ModelBuilder modelBuilder);
    }
}
