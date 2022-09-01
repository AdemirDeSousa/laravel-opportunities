import Nav from "react-bootstrap/Nav";
import Navbar from "react-bootstrap/Navbar";
import Container from "react-bootstrap/Container";

const Header = () => {
  return (
    <Navbar bg="dark" variant="dark">
      <Container>
        <Navbar.Brand href="#home">Laravel-Opportunities</Navbar.Brand>
        <Nav className="me-auto">
          <Nav.Link href="/opportunities">Oportunidades</Nav.Link>
          <Nav.Link href="/clients">Clientes</Nav.Link>
          <Nav.Link href="/products">Produtos</Nav.Link>
        </Nav>
      </Container>
    </Navbar>
  );
};

export default Header;
