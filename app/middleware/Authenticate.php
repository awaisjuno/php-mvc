<?php 

namespace Middleware;

class Authenticate {
    
    public function handle($request, $next)
    {

        echo "<h3>Calling Middleware.</h3>";
        return $next($request);
    }

}

?>