package app

import io.jooby.Kooby
import io.jooby.runApp

class App: Kooby({

  get("/") {
    "Hello Haidar"
  }
})

fun main(args: Array<String>) {
  runApp(args, App::class)
}
