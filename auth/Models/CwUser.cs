using System;
using System.Collections.Generic;

#nullable disable

namespace auth.Models
{
    public partial class CwUser
    {
        public CwUser()
        {
            CwPasswords = new HashSet<CwPassword>();
            CwSessions = new HashSet<CwSession>();
        }

        public int UserId { get; set; }
        public string FirstName { get; set; }
        public string LastName { get; set; }
        public string Email { get; set; }

        public virtual ICollection<CwPassword> CwPasswords { get; set; }
        public virtual ICollection<CwSession> CwSessions { get; set; }
    }
}
