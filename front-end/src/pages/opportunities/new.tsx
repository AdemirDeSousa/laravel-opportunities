import { Formik, Form, Field } from 'formik'
import { useRouter } from 'next/router'

import { http } from '../../axios/request'


const NewOpportunity = () => {
    
  const router = useRouter()

  const formInitialValues = {
    title: '',
    client_id: '',
    product_id: ''
  }

  const formOnSubmit = async (data: any) => {

    await http.post('/opportunities', data)
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


                <div>
                  <label>Clientes</label>
                  <Field as="select" name="client_id" placeholder="Selecione">
                    <option value="">Selecione</option>
                    {categories?.map(item => (
                      <option key={item.value} value={item.value}>
                        {item.label}
                      </option>
                    ))}
                  </Field>
                  {errors.category_id && touched.category_id && (
                    <S.ErrorMsg>{errors.category_id}</S.ErrorMsg>
                  )}
               
                </div>
            
                <button type='submit'>Enviar</button>

              </div>
            </Form>
        </Formik>
      </section>
    </>
  )
}

export default NewOpportunity