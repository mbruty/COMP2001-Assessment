using System;

#nullable disable

namespace Auth.Models
{
    public partial class Session
    {
        public int SessionId { get; set; }
        public int? UserId { get; set; }
        public DateTime? IssuedAt { get; set; }

        public virtual User User { get; set; }
    }
}