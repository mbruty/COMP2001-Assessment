using System;
using System.Collections.Generic;

#nullable disable

namespace auth.Models
{
    public partial class CwPassword
    {
        public int PwdId { get; set; }
        public string Pwd { get; set; }
        public DateTime? ChangedAt { get; set; }
        public int? UserId { get; set; }

        public virtual CwUser User { get; set; }
    }
}
