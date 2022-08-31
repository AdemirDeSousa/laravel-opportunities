import { useEffect, useState } from 'react'
import { http } from '../../axios/request'

import Middleware from '../../components/Middleware'

const Products = () => {

  const [products, setProducts] = useState() as any

  const getProducts = async () => {
    const response = await http.get('/products')

    setProducts(response.data.data)

  }

  useEffect(() => {
    getProducts()
  }, [])

  return (
    <>
      <Middleware>

        {products?.map((item, index) => (
         <p key={index}>
            {item.title}
          </p>
        ))}
        
      </Middleware>
    </>
  )
}

export default Products