import { useSession } from 'next-auth/react'

const Middleware = props => {
  const { data: status } = useSession()

  if (status === 'loading') {
    return <p>Carregando</p>
  }

  if (status === 'unauthenticated') {
    if (typeof window === 'undefined') return
    window.location.href = `${process.env.NEXT_PUBLIC_SITE_URL}/auth/login`
    return null
  }

  if (status === null) {
    if (typeof window === 'undefined') return
    window.location.href = `${process.env.NEXT_PUBLIC_SITE_URL}/auth/login`
    return null
  }

  return props.children
}

export default Middleware