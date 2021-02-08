using System;

#nullable disable

namespace Auth.Models
{
    public partial class Password
    {
        public int PasswordId { get; set; }
        public int? UserId { get; set; }
        public byte[] Password1 { get; set; }
        public DateTime? ChangedAt { get; set; }

        public virtual User User { get; set; }
    }
}