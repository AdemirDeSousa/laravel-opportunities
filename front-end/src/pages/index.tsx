import { useEffect, useState } from "react";
import { http } from "../axios/request";
import Header from "../components/Header";

import Middleware from "../components/Middleware";

const Home = () => {
  return (
    <>
      <Middleware>
        <Header />
      </Middleware>
    </>
  );
};

export default Home;
