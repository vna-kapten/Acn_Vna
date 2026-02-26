# Fix Admin Role Redirection Issue

## Tasks
- [x] Register AdminMiddleware in app/Http/Kernel.php with 'admin' alias.
- [x] Add 'admin' middleware to admin routes group in routes/web.php.
- [x] Verify that admin users are now properly redirected to admin dashboard instead of member pages.
