  package com.haidarvm.pgstart

import io.vertx.core.AbstractVerticle
import io.vertx.core.Promise


  class MainVerticle : AbstractVerticle() {

  override fun start(startPromise: Promise<Void>) {


    vertx
      .createHttpServer()
        .requestHandler { req ->
        req.response()
          .putHeader("content-type", "text/plain")
          .end("Hello Haidar")
      }
      .listen(8888) { http ->
        if (http.succeeded()) {
          startPromise.complete()
          println("HTTP server started on port 8888")
        } else {
          startPromise.fail(http.cause());
        }
      }
  }
}
