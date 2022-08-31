import axios from 'axios'
import { getSession } from 'next-auth/react'

export const customAxios = axios.create({
  baseURL: process.env.NEXT_PUBLIC_API_URL,
  headers: {
    'Content-Type': 'application/json'
  }
})

export const http = axios.create({
  baseURL: process.env.NEXT_PUBLIC_API_URL,
  timeout: 20000
})

// Add a request interceptor
http.interceptors.request.use(
  async config => {
    const session = await getSession()
    config.headers = {
      Authorization: `Bearer ${session.accessToken}`,
      Accept: 'application/json',
      'Content-Type': 'application/json'
    }
    return config
  },
  function (error) {
    return Promise.reject(error)
  }
)

// Add a response interceptor
http.interceptors.response.use(
  response => {
    if (response.status === 401) {
    }
    return response
  },
  function (error) {
    return Promise.reject(error)
  }
)
