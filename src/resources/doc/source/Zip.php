<?php

/**
 * @apiGroup Zip Information
 * @api {get} /v1/zip/code/:code Retrieves zip code information by code.
 * @apiVersion 0.1.0
 * @apiName GetInfoByZip
 *
 * @apiExample {curl} Example usage:
 *      curl -i -X GET "http://localhost:44444/api/v1/zip/code/00601" \
 *      -H "Accept: application/json"
 *
 * @apiParam {number} code Zip code.
 *
 * @apiSuccessExample {json} Success-Response 200
 *      HTTP/1.1 200 OK
 *
 *      {
 *          "zip":"00601",
 *          "city":"Adjuntas"
 *      }
 *
 * @apiSuccess {string} zip Zip code.
 * @apiSuccess {string} city City name.
 *
 * @apiErrorExample {json} Error-Response 404
 *      HTTP/1.1 404 Not Found
 *
 *      {
 *          "message": "Record not found"
 *      }
 *
 * @apiError {string} message Error message.
 */

/**
 * @apiGroup Zip Information
 * @api {get} /v1/zip/city/:city Retrieves zip code information by city name.
 * @apiVersion 0.1.0
 * @apiName GetInfoByCity
 *
 * @apiExample {curl} Example usage:
 *      curl -i -X GET "http://localhost:44444/api/v1/zip/city/gu" \
 *      -H "Accept: application/json"
 *
 * @apiParam {string} city Full or partial name of the city.
 *
 * @apiSuccessExample {json} Success-Response 200
 *      HTTP/1.1 200 OK
 *
 *      {
 *          "data":[
 *              {
 *                  "zip":"00602",
 *                  "city":"Aguada"
 *              },
 *              ...
 *              {
 *                  "zip":"00656",
 *                  "city":"Guayanilla"
 *              }
 *          ],
 *          "links":{
 *              "first":"http:\/\/localhost:44444\/api\/v1\/zip\/city\/gu?page=1",
 *              "last":"http:\/\/localhost:44444\/api\/v1\/zip\/city\/gu?page=1",
 *              "prev":null,
 *              "next":null
 *          },
 *          "meta":{
 *              "current_page":1,
 *              "from":1,
 *              "last_page":1,
 *              "path":"http:\/\/localhost:44444\/api\/v1\/zip\/city\/gu",
 *              "per_page":20,
 *              "to":7,
 *              "total":7
 *          }
 *      }
 *
 * @apiSuccess {array} data Zip code collection.
 * @apiSuccess {string} data.zip Zip code.
 * @apiSuccess {string} data.city City name.
 * @apiSuccess {array} links
 * @apiSuccess {string} links.first URL of the first item in the results.
 * @apiSuccess {string} links.last URL of the last item in the results.
 * @apiSuccess {string} links.prev URL for the previous page.
 * @apiSuccess {string} links.next URL for the next page.
 * @apiSuccess {array} meta
 * @apiSuccess {number} meta.current_page Current page number.
 * @apiSuccess {number} meta.from The number of the first element on the page.
 * @apiSuccess {number} meta.last_page Last available page.
 * @apiSuccess {string} meta.path Pagination URL.
 * @apiSuccess {number} meta.per_page The number of items to be shown per page.
 * @apiSuccess {number} meta.to The number of the last item on the page
 * @apiSuccess {number} meta.total Total number of matching items in the data store.
 */
