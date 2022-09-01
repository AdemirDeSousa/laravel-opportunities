import { useEffect, useState } from "react";
import { http } from "../../axios/request";
import Header from "../../components/Header";
import { Container, Row, Button, Table } from "react-bootstrap";
import Col from "react-bootstrap/Col";
import Link from "next/link";

import Middleware from "../../components/Middleware";

const Products = () => {
  const [products, setProducts] = useState() as any;

  const getProducts = async () => {
    const response = await http.get("/products");

    setProducts(response.data.data);
  };

  useEffect(() => {
    getProducts();
  }, []);

  return (
    <>
      <Middleware>
        <Header />

        <Container className="mt-5">
          <Row className="justify-content-md-center">
            <Col lg={8}>
              <Link href={"/products/new"} className="mb-5">
                <Button variant="success">Cadastrar</Button>
              </Link>
              <Table striped bordered hover size="sm">
                <thead>
                  <tr>
                    <th>Nome do Produto</th>
                  </tr>
                </thead>
                <tbody>
                  {products?.map((item) => (
                    <tr key={item.id}>
                      <td>{item.title}</td>
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

export default Products;
