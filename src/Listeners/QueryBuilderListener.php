<?php

namespace Bkqw\Log\Listeners;

use Bkqw\Log\Log\Facades\SQLLogService;
use Illuminate\Database\Events\QueryExecuted;

class QueryBuilderListener
{
    /**
     * Create the event listener.
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     * @param  QueryExecuted $event
     * @return void
     */
    public function handle(QueryExecuted $event)
    {
        SQLLogService::write($event);
    }
}
