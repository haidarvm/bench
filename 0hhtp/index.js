const cero = require('0http')
const { router, server } = cero()

router.get('/', (req, res) => {
    res.end('Hello World!')
})

router.post('/do', (req, res) => {
    // ...
    res.statusCode = 201
    res.end()
})

//...

server.listen(3000)