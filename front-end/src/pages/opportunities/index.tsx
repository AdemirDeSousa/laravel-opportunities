import { useEffect, useState } from 'react'
import { http } from '../../axios/request'

import Middleware from '../../components/Middleware'

const Opportunities = () => {

  const [opportunities, setOpportunities] = useState() as any

  const getOpportunities = async () => {
    const response = await http.get('/opportunities')

    setOpportunities(response.data.data)

  }

  useEffect(() => {
    getOpportunities()
  }, [])

  return (
    <>
      <Middleware>

        {opportunities?.map((item, index) => (
         <p key={index}>
            {item.title} / {item.seller} / {item.client} / {item.product} / 
          </p>
        ))}
        
      </Middleware>
    </>
  )
}

export default Opportunities