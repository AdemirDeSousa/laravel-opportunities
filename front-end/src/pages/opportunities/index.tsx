import { useEffect, useState } from "react";
import { Button, Table } from "react-bootstrap";
import Container from "react-bootstrap/Container";
import Row from "react-bootstrap/Row";
import Col from "react-bootstrap/Col";
import { http } from "../../axios/request";

import Middleware from "../../components/Middleware";
import Header from "../../components/Header";
import Link from "next/link";
import { Field, Form, Formik } from "formik";

const Opportunities = () => {
  const [opportunities, setOpportunities] = useState() as any;
  const [filters, setFilters] = useState("");

  const getOpportunities = async () => {
    const response = await http.get(`/opportunities${filters}`);

    setOpportunities(response.data.data);
  };

  useEffect(() => {
    getOpportunities();
  }, [filters]);

  const filtersInitialValues = {
    title: "",
  };

  const filtersOnSubmit = async (data: { title: string }) => {
    setFilters(`?title=${data.title}`);
  };

  return (
    <>
      <Middleware>
        <Header />

        <Container className="mt-5">
          <Row className="justify-content-md-center">
            <Col lg={8}>
              <Formik
                onSubmit={filtersOnSubmit}
                initialValues={filtersInitialValues}
              >
                {() => (
                  <Form className="d-flex gap-4 mb-5">
                    <Field
                      className="w-50"
                      placeholder="Nome da Oportunidade"
                      id="title"
                      name="title"
                    />

                    <Button type="submit">Buscar</Button>
                  </Form>
                )}
              </Formik>

              <Table striped bordered hover size="sm">
                <thead>
                  <tr>
                    <th>Nome da Oportunidade</th>
                    <th>Vendedor</th>
                    <th>Cliente</th>
                    <th>Produto</th>
                    <th>Ações</th>
                  </tr>
                </thead>
                <tbody>
                  {opportunities?.map((item) => (
                    <tr key={item.id}>
                      <td>{item.title}</td>
                      <td>{item.seller}</td>
                      <td>{item.client}</td>
                      <td>{item.product}</td>
                      <td>
                        <Link href={`/opportunities/${item.id}`}>
                          <Button variant="link">Atualizar</Button>
                        </Link>
                      </td>
                    </tr>
                  ))}
                </tbody>
              </Table>
            </Col>
          </Row>
        </Container>
      </Middleware>
    </>
  );
};

export default Opportunities;
