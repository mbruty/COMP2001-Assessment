using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Http;
using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;
using Auth.Models;
using Microsoft.Data.SqlClient;

namespace Auth.Controllers.api
{
    [Route("api/[controller]")]
    [ApiController]
    public class UserController : ControllerBase
    {
        private readonly COMP2001_MBrutyContext _context;

        public UserController(COMP2001_MBrutyContext context)
        {
            _context = context;
        }

        // GET: api/User
        [HttpGet]
        public async Task<ActionResult<User>> GetUser(User user)
        {
            int result = await _context.Database.ExecuteSqlRawAsync("EXECUTE ValidateUser @email, @password",
                new SqlParameter("@email", user.Email),
                new SqlParameter("@password", user.Password)
            );
            return result == 1 ? StatusCode(200, new Validated { validated = true }) : StatusCode(400, new Validated { validated = false });
        }

        // PUT: api/User/5
        // To protect from overposting attacks, enable the specific properties you want to bind to, for
        // more details, see https://go.microsoft.com/fwlink/?linkid=2123754.
        [HttpPut("{id}")]
        public async Task<IActionResult> PutUser(int id, User user)
        {
            SqlParameter firstName = new SqlParameter { ParameterName = "@first_name", Value = user.FirstName, IsNullable = true };
            if(user.FirstName == null)
            {
                firstName.Value = DBNull.Value;
            }
            SqlParameter lastName = new SqlParameter { ParameterName = "@last_name", Value = user.LastName, IsNullable = true };
            if(user.LastName == null)
            {
                lastName.Value = DBNull.Value;
            }
            SqlParameter password = new SqlParameter { ParameterName = "@password", Value = user.Password, IsNullable = true };
            if(user.Password == null)
            {
                password.Value = DBNull.Value;
            }
            SqlParameter email = new SqlParameter { ParameterName = "@email", Value = user.Email, IsNullable = true };
            if(user.Email == null)
            {
                email.Value = DBNull.Value;
            }
            await _context.Database.ExecuteSqlRawAsync("EXECUTE UpdateUser @first_name, @last_name, @email, @password, @id",
                firstName,
                lastName,
                password,
                email,
                new SqlParameter("@id", id)
            );
            return Ok();
        }

        // POST: api/User
        // To protect from overposting attacks, enable the specific properties you want to bind to, for
        // more details, see https://go.microsoft.com/fwlink/?linkid=2123754.
        [HttpPost]
        public async Task<ActionResult<User>> PostUser(User user)
        {
            var param = new SqlParameter { ParameterName = "@response", Direction = System.Data.ParameterDirection.Output, Size = 10000 };
            await _context.Database.ExecuteSqlRawAsync("EXECUTE Register @first_name, @last_name, @password, @email, @response OUTPUT",
                new SqlParameter("@first_name", user.FirstName),
                new SqlParameter("@last_name", user.LastName),
                new SqlParameter("@password", user.Password),
                new SqlParameter("@email", user.Email),
                param
            );
            string[] results = param.Value.ToString().Split(',');
            switch (results[0])
            {
                case "200":
                    return Ok(new UserResult { UserID = Convert.ToInt32(results[1]) });
                case "208":
                    return StatusCode(208);
                default:
                    return NotFound();
            }
        }

        // DELETE: api/User/5
        [HttpDelete("{id}")]
        public async Task<ActionResult<User>> DeleteUser(int id)
        {
            await _context.Database.ExecuteSqlRawAsync("EXECUTE DeleteUser @id",
                new SqlParameter("@id", id)
            );
            return NoContent();
        }

        private bool UserExists(int id)
        {
            return _context.Users.Any(e => e.UserId == id);
        }

        private class Validated
        {
            public bool validated { get; set; }
        }

        private class UserResult
        {
            public int UserID { get; set; }
        }
    }
}
