/// <reference types="es4x" />
// @ts-check

vertx
    .createHttpServer()
    .requestHandler(function(req) {
        req.response().end("Hello haidar");
    })
    .listen(8080);

console.log('Server listening at: http://localhost:8080/');