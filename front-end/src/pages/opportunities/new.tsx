import { useEffect, useState } from "react";
import { Formik, Form, Field } from "formik";
import { useRouter } from "next/router";

import { http } from "../../axios/request";
import Middleware from "../../components/Middleware";
import Header from "../../components/Header";
import { Col, Container, Row } from "react-bootstrap";

const NewOpportunity = () => {
  const router = useRouter();

  const [clients, setClients] = useState() as any;
  const [products, setProducts] = useState() as any;

  const getClients = async () => {
    const response = await http.get("/select-options/clients");

    setClients(response.data.data);
  };

  const getProducts = async () => {
    const response = await http.get("/select-options/products");

    setProducts(response.data.data);
  };

  useEffect(() => {
    getClients();
    getProducts();
  }, []);

  const formInitialValues = {
    title: "",
    client_id: "",
    product_id: "",
  };

  const formOnSubmit = async (data: any) => {
    await http
      .post("/opportunities", data)
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
      <Middleware>
        <Header />

        <Container className="mt-5">
          <Row className="justify-content-md-center">
            <Col lg={8}>
              <Formik onSubmit={formOnSubmit} initialValues={formInitialValues}>
                <Form>
                  <div>
                    <div>
                      <label htmlFor="title">Nome da Oportunidade</label>
                      <Field id="title" name="title" />
                    </div>

                    <div>
                      <label>Clientes</label>
                      <Field
                        as="select"
                        name="client_id"
                        placeholder="Selecione"
                      >
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
                      <Field
                        as="select"
                        name="product_id"
                        placeholder="Selecione"
                      >
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
            </Col>
          </Row>
        </Container>
      </Middleware>
    </>
  );
};

export default NewOpportunity;
