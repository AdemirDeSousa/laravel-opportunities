import { Formik, Form, Field } from "formik";
import { useRouter } from "next/router";
import { Col, Container, Row } from "react-bootstrap";
import Middleware from "../../components/Middleware";
import Header from "../../components/Header";

import { http } from "../../axios/request";

const NewClient = () => {
  const router = useRouter();

  const formInitialValues = {
    name: "",
    email: "",
  };

  const formOnSubmit = async (data: any) => {
    await http
      .post("/clients", data)
      .then(() => {
        console.log("sucesso");

        setTimeout(() => {
          router.push("/clients");
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
                      <label htmlFor="name">Nome</label>
                      <Field id="name" name="name" />
                    </div>

                    <div>
                      <label htmlFor="email">Email</label>
                      <Field id="email" name="email" />
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

export default NewClient;
