using System;
using System.Collections.Generic;

#nullable disable

namespace auth.Models
{
    public partial class CwSession
    {
        public int SessionId { get; set; }
        public string AuthToken { get; set; }
        public DateTime? IssuedAd { get; set; }
        public int? UserId { get; set; }

        public virtual CwUser User { get; set; }
    }
}
