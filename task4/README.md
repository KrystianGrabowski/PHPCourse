# Products system

* List all products
```
    GET http://localhost:8888/products
```
* Create new product
```
    POST http://localhost:8888/products

    {   
      "id": 2,
      "name": "Second product",
      "amount": 2,
      "currency": "PLN"
    }
```
* List one particular product
```
    GET http://localhost:8888/products/{id}
```
* Edit product
```
    PUT http://localhost:8888/products/{id}

    {
      "name": "Second product UPDATED",
      "amount": 22,
      "currency": "PLN"
    }
```
* Delete product
```
    DELETE http://localhost:8888/products/{id}
```


