import { Formik, Form, Field } from 'formik'
import { useRouter } from 'next/router'

import { http } from '../../axios/request'


const NewProduct = () => {
    
  const router = useRouter()

  const formInitialValues = {
    title: ''
  }

  const formOnSubmit = async (data: any) => {

    await http.post('/products', data)
        .then(() => {
        console.log('sucesso')

        setTimeout(() => {
          router.push('/products')
        }, 2000)
      })

      .catch(error => {
        console.log(error)
      })
  }

  return (
    <>
      <section>
        <Formik
          onSubmit={formOnSubmit}
          initialValues={formInitialValues}
        >
          <Form>
              <div>  
                <div>
                    <label htmlFor="title">Nome do Produto</label>
                    <Field id="title" name="title" />
                </div>
            
                <button type='submit'>Enviar</button>

              </div>
            </Form>
        </Formik>
      </section>
    </>
  )
}

export default NewProduct