<?php

/**
 * @apiGroup HealthCheck
 * @api {get} /health-check Checking the health status of the main functional.
 * @apiVersion 0.1.0
 * @apiName HealthCheck
 * @apiDescription Performs verification of major systems returns their readiness status.
 *
 * @apiExample {curl} Example usage:
 *      curl -i -X GET "http://localhost:44444/api/health-check" \
 *      -H "Accept: application/json"
 *
 * @apiSuccessExample {json} Success-Response 200
 *      HTTP/1.1 200 OK
 *
 *      {
 *          "mongodb-server": true,
 *          "redis-server": true
 *      }
 *
 * @apiSuccess {boolean} mongodb-server MongoDB server status.
 * @apiSuccess {boolean} redis-server Redis server status.
 */
