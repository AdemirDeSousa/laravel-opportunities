import { useEffect, useState } from 'react'
import { http } from '../axios/request'

import Middleware from '../components/Middleware'

const Home = () => {

  const [clients, setClients] = useState() as any

  const getClients = async () => {
    const response = await http.get('/clients')

    setClients(response.data.data)

  }

  useEffect(() => {
    getClients()
  }, [])

  return (
    <>
      <Middleware>

        {clients?.map((item, index) => (
         <p key={index}>
          {item.name} / {item.email}
          </p>
        ))}
        
      </Middleware>
    </>
  )
}

export default Home