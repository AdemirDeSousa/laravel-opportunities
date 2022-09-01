import React, { useState } from "react";

import { useFormik } from "formik";
import { signIn } from "next-auth/react";
import { useRouter } from "next/router";
import * as yup from "yup";
import { Col, Container, Form, Row } from "react-bootstrap";
import Button from "react-bootstrap/Button";

const Login = () => {
  const [loading, setLoading] = useState(false);
  const router = useRouter();

  const schema = yup.object().shape({
    password: yup.string().required("Informe sua senha.").typeError("Senha"),
    email: yup
      .string()
      .email("Informe um email válido.")
      .required("Informe o seu email."),
  });

  const formik = useFormik({
    initialValues: {
      email: "",
      password: "",
    },
    validationSchema: schema,
    onSubmit: async (values, onSubmitProps) => {
      onSubmitProps.resetForm();
      setLoading(true);

      const response = await signIn("credentials", {
        username: values.email,
        password: values.password,
        redirect: false,
      });

      if (!response.ok) {
        setLoading(false);
        console.log("sucesso");
      } else {
        setLoading(true);
        console.log("erro");
        router.push("/");
      }
    },
  });

  return (
    <>
      <Container className="mt-5">
        <Row className="justify-content-md-center">
          <Col lg={8}>
            <form onSubmit={formik.handleSubmit}>
              <div className="d-flex flex-column gap-4">
                <div className="form-input">
                  <label>Digite seu e-mail</label>
                  <Form.Control
                    id="email"
                    type="email"
                    name="email"
                    onChange={formik.handleChange}
                    value={formik.values.email}
                    onBlur={formik.handleBlur}
                  />
                  {formik.touched.email && formik.errors.email ? (
                    <span
                      style={{
                        fontSize: "12px",
                        color: "red",
                        marginBottom: "2vw",
                      }}
                    >
                      {formik.errors.email}
                    </span>
                  ) : null}
                </div>
                <div className="form-input position-relative">
                  <label>Digite sua senha</label>
                  <Form.Control
                    id="password"
                    type="password"
                    name="password"
                    onChange={formik.handleChange}
                    value={formik.values.password}
                    onBlur={formik.handleBlur}
                  />

                  {formik.touched.password && formik.errors.password ? (
                    <span
                      style={{
                        fontSize: "12px",
                        color: "red",
                        marginBottom: "2vw",
                      }}
                    >
                      {formik.errors.password}
                    </span>
                  ) : null}
                </div>

                <Button type="submit" variant="outline-info">
                  Acessar
                </Button>
              </div>
            </form>
          </Col>
        </Row>
      </Container>
    </>
  );
};

export default Login;
