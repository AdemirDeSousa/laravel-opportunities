import NextAuth, { NextAuthOptions } from "next-auth";
import CredentialsProvider from "next-auth/providers/credentials";

import { customAxios } from "../../../axios/request";

export const authOptions: NextAuthOptions = {
  providers: [
    CredentialsProvider({
      name: "Credentials",
      credentials: {
        username: { label: "Username", type: "email" },
        password: { label: "Password", type: "password" },
      },
      async authorize(credentials) {
        const fields = {
          email: credentials.username,
          password: credentials.password,
        };

        try {
          const { data } = await customAxios.post(
            `${process.env.NEXT_PUBLIC_API_URL}/auth/login`,
            fields
          );

          if (data) {
            const { access_token } = data;

            if (!access_token) {
              return null;
            }

            return {
              access_token,
            };
          }
        } catch (e) {
          return null;
        }
      },
    }),
  ],
  pages: {
    // signIn: '/auth/login'
    // signOut: '/auth/logout',
    // error: '/auth/error',
    // verifyRequest: '/auth/verify-request',
    // newUser: '/auth/new-user'
  },
  secret: process.env.NEXTAUTH_SECRET,
  session: {
    strategy: "jwt",
    maxAge: 60 * 60 * 24, //  24h
  },
  jwt: {
    secret: process.env.JWT_SIGNING_PRIVATE_KEY,
    maxAge: 60 * 60 * 24, // 24h
  },
  callbacks: {
    async jwt({ token, user }) {
      const isSignIn = !!user;
      const actualDate = Math.floor(Date.now() / 1000);
      const tokenDestroy = Math.floor(60 * 60); // 60min

      if (isSignIn) {
        token.jwt = user.access_token;
        token.destroy = Math.floor(actualDate + tokenDestroy);
      } else {
        if (!token.destroy) {
          return Promise.resolve({});
        }

        if (actualDate > token.destroy) {
          return Promise.resolve({});
        }
      }

      return Promise.resolve(token);
    },

    async session({ session, token }) {
      if (!token?.jti || !token?.destroy) {
        return null;
      }

      session.accessToken = token.jwt;

      return session;
    },
  },
  debug: false,
};

export default NextAuth(authOptions);
