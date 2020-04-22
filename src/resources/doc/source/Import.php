<?php

/**
 * @apiGroup Import DB
 * @api {post} /v1/import/file-csv Import data into a database from a csv file.
 * @apiVersion 0.1.0
 * @apiName Import
 *
 * @apiExample {curl} Example usage:
 *      curl -i -F db=@uszips.csv "http://localhost:44444/api/v1/import/file-csv" \
 *      -H "Accept: application/json" \
 *      -H 'Content-Type: multipart/form-data'
 *
 * @apiSuccessExample {json} Success-Response 204
 *      HTTP/1.1 204 No Content
 *
 * @apiErrorExample {json} Error-Response 422
 *      HTTP/1.1 422 Unprocessable Entity
 *
 *      {
 *          "message": "Not all required fields: city"
 *      }
 *
 * @apiError {string} message Error message.
 *
 */