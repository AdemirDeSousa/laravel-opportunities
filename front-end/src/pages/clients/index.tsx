import { useEffect, useState } from "react";
import { Container, Row, Button, Table } from "react-bootstrap";
import { http } from "../../axios/request";
import Header from "../../components/Header";
import Col from "react-bootstrap/Col";
import Link from "next/link";

import Middleware from "../../components/Middleware";

const Home = () => {
  const [clients, setClients] = useState() as any;

  const getClients = async () => {
    const response = await http.get("/clients");

    setClients(response.data.data);
  };

  useEffect(() => {
    getClients();
  }, []);

  return (
    <>
      <Middleware>
        <Header />
        <Container className="mt-5">
          <Row className="justify-content-md-center">
            <Col lg={8}>
              <Link href={"/clients/new"} className="mb-5">
                <Button variant="success">Cadastrar</Button>
              </Link>
              <Table striped bordered hover size="sm">
                <thead>
                  <tr>
                    <th>Nome do Cliente</th>
                    <th>Email</th>
                  </tr>
                </thead>
                <tbody>
                  {clients?.map((item) => (
                    <tr key={item.id}>
                      <td>{item.name}</td>
                      <td>{item.email}</td>
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

export default Home;
