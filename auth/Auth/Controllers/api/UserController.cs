using Auth.Models;
using Microsoft.AspNetCore.Mvc;
using System;
using System.Linq;
using System.Threading.Tasks;

namespace Auth.Controllers.api
{
    [Route("api/user")]
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
            return Ok(new Validated { validated = await _context.Validate(user) });
        }

        // PUT: api/User/5
        [HttpPut("{id}")]
        public async Task<IActionResult> PutUser(int id, User user)
        {
            await _context.Update(user, id);
            return Ok();
        }

        // POST: api/User
        [HttpPost]
        public async Task<ActionResult<User>> PostUser(User user)
        {
            string result = await _context.Register(user);
            string[] results = result.Split(',');

            return (results[0]) switch
            {
                "200" => Ok(new UserResult { UserID = Convert.ToInt32(results[1]) }),
                "208" => StatusCode(208),
                _ => NotFound(),
            };
        }

        // DELETE: api/User/5
        [HttpDelete("{id}")]
        public async Task<ActionResult<User>> DeleteUser(int id)
        {
            await _context.Delete(id);
            return NoContent();
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