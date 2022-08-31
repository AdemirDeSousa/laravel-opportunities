import NextAuth from 'next-auth'

declare module 'next-auth' {
  /**
   * Returned by `useSession`, `getSession` and received as a prop on the `SessionProvider` React Context
   */
  interface Session {
    user: {
      name: string
      email: string
      role: any
      permissions: any
    }
  }
}

declare module 'next-auth' {
  /** Returned by the `jwt` callback and `getToken`, when using JWT sessions */
  interface User {
    user: {
      name: string
      email: string
      role: any
      permissions: any
    }
  }
}
