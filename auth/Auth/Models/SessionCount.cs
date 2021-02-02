using System;
using System.Collections.Generic;

#nullable disable

namespace Auth.Models
{
    public partial class SessionCount
    {
        public int? UserId { get; set; }
        public int? LoginCount { get; set; }
    }
}
