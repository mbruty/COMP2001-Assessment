using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Http;
using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;
using auth.Models;

namespace auth.Controllers
{
    [Route("api/[controller]")]
    [ApiController]
    public class CwUsersController : ControllerBase
    {
        private readonly COMP2001_MBrutyContext _context;

        public CwUsersController(COMP2001_MBrutyContext context)
        {
            _context = context;
        }

        // GET: api/CwUsers
        [HttpGet]
        public async Task<ActionResult<IEnumerable<CwUser>>> GetCwUsers()
        {
            return await _context.CwUsers.ToListAsync();
        }

        // GET: api/CwUsers/5
        [HttpGet("{id}")]
        public async Task<ActionResult<CwUser>> GetCwUser(int id)
        {
            var cwUser = await _context.CwUsers.FindAsync(id);

            if (cwUser == null)
            {
                return NotFound();
            }

            return cwUser;
        }

        // PUT: api/CwUsers/5
        // To protect from overposting attacks, enable the specific properties you want to bind to, for
        // more details, see https://go.microsoft.com/fwlink/?linkid=2123754.
        [HttpPut("{id}")]
        public async Task<IActionResult> PutCwUser(int id, CwUser cwUser)
        {
            if (id != cwUser.UserId)
            {
                return BadRequest();
            }

            _context.Entry(cwUser).State = EntityState.Modified;

            try
            {
                await _context.SaveChangesAsync();
            }
            catch (DbUpdateConcurrencyException)
            {
                if (!CwUserExists(id))
                {
                    return NotFound();
                }
                else
                {
                    throw;
                }
            }

            return NoContent();
        }

        // POST: api/CwUsers
        // To protect from overposting attacks, enable the specific properties you want to bind to, for
        // more details, see https://go.microsoft.com/fwlink/?linkid=2123754.
        [HttpPost]
        public async Task<ActionResult<CwUser>> PostCwUser(CwUser cwUser)
        {
            _context.CwUsers.Add(cwUser);
            await _context.SaveChangesAsync();

            return CreatedAtAction("GetCwUser", new { id = cwUser.UserId }, cwUser);
        }

        // DELETE: api/CwUsers/5
        [HttpDelete("{id}")]
        public async Task<ActionResult<CwUser>> DeleteCwUser(int id)
        {
            var cwUser = await _context.CwUsers.FindAsync(id);
            if (cwUser == null)
            {
                return NotFound();
            }

            _context.CwUsers.Remove(cwUser);
            await _context.SaveChangesAsync();

            return cwUser;
        }

        private bool CwUserExists(int id)
        {
            return _context.CwUsers.Any(e => e.UserId == id);
        }
    }
}
