import { useEffect, useState } from "react";
import { Formik, Form, Field } from "formik";
import { useRouter } from "next/router";

import { http } from "../../axios/request";

const EditOpportunity = () => {
  const router = useRouter();

  const [clients, setClients] = useState() as any;
  const [products, setProducts] = useState() as any;
  const [opportunity, setOpportunity] = useState() as any;

  const getClients = async () => {
    const response = await http.get("/select-options/clients");

    setClients(response.data.data);
  };

  const getProducts = async () => {
    const response = await http.get("/select-options/products");

    setProducts(response.data.data);
  };

  console.log(router);
  const getOpportunityById = async () => {
    const response = await http.get(
      `/opportunities/${router.query.opportunityId}`
    );

    setOpportunity(response.data.data);
  };

  useEffect(() => {
    getClients();
    getProducts();
    getOpportunityById();
  }, []);

  const formInitialValues = {
    title: opportunity?.title,
    client_id: opportunity?.client_id,
    product_id: opportunity?.product_id,
  };

  const formOnSubmit = async (data: any) => {
    await http
      .put(`/opportunities/${router.query.opportunityId}`, data)
      .then(() => {
        console.log("sucesso");

        setTimeout(() => {
          router.push("/opportunities");
        }, 2000);
      })

      .catch((error) => {
        console.log(error);
      });
  };

  return (
    <>
      <section>
        <Formik
          onSubmit={formOnSubmit}
          initialValues={formInitialValues}
          enableReinitialize
        >
          <Form>
            <div>
              <div>
                <label htmlFor="title">Nome da Oportunidade</label>
                <Field id="title" name="title" />
              </div>

              <div>
                <label>Clientes</label>
                <Field as="select" name="client_id" placeholder="Selecione">
                  <option value="">Selecione</option>
                  {clients?.map((item) => (
                    <option key={item.key} value={item.key}>
                      {item.value}
                    </option>
                  ))}
                </Field>
              </div>

              <div>
                <label>Produtos</label>
                <Field as="select" name="product_id" placeholder="Selecione">
                  <option value="">Selecione</option>
                  {products?.map((item) => (
                    <option key={item.key} value={item.key}>
                      {item.value}
                    </option>
                  ))}
                </Field>
              </div>

              <button type="submit">Enviar</button>
            </div>
          </Form>
        </Formik>
      </section>
    </>
  );
};

export default EditOpportunity;
