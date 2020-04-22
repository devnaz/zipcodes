define({ "api": [
  {
    "group": "HealthCheck",
    "type": "get",
    "url": "/health-check",
    "title": "Checking the health status of the main functional.",
    "version": "0.1.0",
    "name": "HealthCheck",
    "description": "<p>Performs verification of major systems returns their readiness status.</p>",
    "examples": [
      {
        "title": "Example usage:",
        "content": "curl -i -X GET \"http://localhost:44444/api/health-check\" \\\n-H \"Accept: application/json\"",
        "type": "curl"
      }
    ],
    "success": {
      "examples": [
        {
          "title": "Success-Response 200",
          "content": "HTTP/1.1 200 OK\n\n{\n    \"mongodb-server\": true,\n    \"redis-server\": true\n}",
          "type": "json"
        }
      ],
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "boolean",
            "optional": false,
            "field": "mongodb-server",
            "description": "<p>MongoDB server status.</p>"
          },
          {
            "group": "Success 200",
            "type": "boolean",
            "optional": false,
            "field": "redis-server",
            "description": "<p>Redis server status.</p>"
          }
        ]
      }
    },
    "filename": "source/HealthCheck.php",
    "groupTitle": "HealthCheck"
  },
  {
    "group": "Import_DB",
    "type": "post",
    "url": "/v1/import/file-csv",
    "title": "Import data into a database from a csv file.",
    "version": "0.1.0",
    "name": "Import",
    "examples": [
      {
        "title": "Example usage:",
        "content": "curl -i -F db=@uszips.csv \"http://localhost:44444/api/v1/import/file-csv\" \\\n-H \"Accept: application/json\" \\\n-H 'Content-Type: multipart/form-data'",
        "type": "curl"
      }
    ],
    "success": {
      "examples": [
        {
          "title": "Success-Response 204",
          "content": "HTTP/1.1 204 No Content",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response 422",
          "content": "HTTP/1.1 422 Unprocessable Entity\n\n{\n    \"message\": \"Not all required fields: city\"\n}",
          "type": "json"
        }
      ],
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "string",
            "optional": false,
            "field": "message",
            "description": "<p>Error message.</p>"
          }
        ]
      }
    },
    "filename": "source/Import.php",
    "groupTitle": "Import_DB"
  },
  {
    "group": "Zip_Information",
    "type": "get",
    "url": "/v1/zip/city/:city",
    "title": "Retrieves zip code information by city name.",
    "version": "0.1.0",
    "name": "GetInfoByCity",
    "examples": [
      {
        "title": "Example usage:",
        "content": "curl -i -X GET \"http://localhost:44444/api/v1/zip/city/gu\" \\\n-H \"Accept: application/json\"",
        "type": "curl"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "city",
            "description": "<p>Full or partial name of the city.</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response 200",
          "content": "HTTP/1.1 200 OK\n\n{\n    \"data\":[\n        {\n            \"zip\":\"00602\",\n            \"city\":\"Aguada\"\n        },\n        ...\n        {\n            \"zip\":\"00656\",\n            \"city\":\"Guayanilla\"\n        }\n    ],\n    \"links\":{\n        \"first\":\"http:\\/\\/localhost:44444\\/api\\/v1\\/zip\\/city\\/gu?page=1\",\n        \"last\":\"http:\\/\\/localhost:44444\\/api\\/v1\\/zip\\/city\\/gu?page=1\",\n        \"prev\":null,\n        \"next\":null\n    },\n    \"meta\":{\n        \"current_page\":1,\n        \"from\":1,\n        \"last_page\":1,\n        \"path\":\"http:\\/\\/localhost:44444\\/api\\/v1\\/zip\\/city\\/gu\",\n        \"per_page\":20,\n        \"to\":7,\n        \"total\":7\n    }\n}",
          "type": "json"
        }
      ],
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "array",
            "optional": false,
            "field": "data",
            "description": "<p>Zip code collection.</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "data.zip",
            "description": "<p>Zip code.</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "data.city",
            "description": "<p>City name.</p>"
          },
          {
            "group": "Success 200",
            "type": "array",
            "optional": false,
            "field": "links",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "links.first",
            "description": "<p>URL of the first item in the results.</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "links.last",
            "description": "<p>URL of the last item in the results.</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "links.prev",
            "description": "<p>URL for the previous page.</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "links.next",
            "description": "<p>URL for the next page.</p>"
          },
          {
            "group": "Success 200",
            "type": "array",
            "optional": false,
            "field": "meta",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "number",
            "optional": false,
            "field": "meta.current_page",
            "description": "<p>Current page number.</p>"
          },
          {
            "group": "Success 200",
            "type": "number",
            "optional": false,
            "field": "meta.from",
            "description": "<p>The number of the first element on the page.</p>"
          },
          {
            "group": "Success 200",
            "type": "number",
            "optional": false,
            "field": "meta.last_page",
            "description": "<p>Last available page.</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "meta.path",
            "description": "<p>Pagination URL.</p>"
          },
          {
            "group": "Success 200",
            "type": "number",
            "optional": false,
            "field": "meta.per_page",
            "description": "<p>The number of items to be shown per page.</p>"
          },
          {
            "group": "Success 200",
            "type": "number",
            "optional": false,
            "field": "meta.to",
            "description": "<p>The number of the last item on the page</p>"
          },
          {
            "group": "Success 200",
            "type": "number",
            "optional": false,
            "field": "meta.total",
            "description": "<p>Total number of matching items in the data store.</p>"
          }
        ]
      }
    },
    "filename": "source/Zip.php",
    "groupTitle": "Zip_Information"
  },
  {
    "group": "Zip_Information",
    "type": "get",
    "url": "/v1/zip/code/:code",
    "title": "Retrieves zip code information by code.",
    "version": "0.1.0",
    "name": "GetInfoByZip",
    "examples": [
      {
        "title": "Example usage:",
        "content": "curl -i -X GET \"http://localhost:44444/api/v1/zip/code/00601\" \\\n-H \"Accept: application/json\"",
        "type": "curl"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "number",
            "optional": false,
            "field": "code",
            "description": "<p>Zip code.</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response 200",
          "content": "HTTP/1.1 200 OK\n\n{\n    \"zip\":\"00601\",\n    \"city\":\"Adjuntas\"\n}",
          "type": "json"
        }
      ],
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "zip",
            "description": "<p>Zip code.</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "city",
            "description": "<p>City name.</p>"
          }
        ]
      }
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response 404",
          "content": "HTTP/1.1 404 Not Found\n\n{\n    \"message\": \"Record not found\"\n}",
          "type": "json"
        }
      ],
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "string",
            "optional": false,
            "field": "message",
            "description": "<p>Error message.</p>"
          }
        ]
      }
    },
    "filename": "source/Zip.php",
    "groupTitle": "Zip_Information"
  }
] });
