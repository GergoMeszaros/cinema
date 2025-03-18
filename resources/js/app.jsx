import React from "react";
import ReactDom from "react-dom/client";
import {BrowserRouter as Router, Routes, Route} from 'react-router-dom';
import Movies from "@/components/Movies.jsx";

function App() {
    return (
        <Router>
            <Routes>
                <Route path={"/"} element={<Movies/>}/>
            </Routes>
        </Router>
    )
}

const rootElement = document.getElementById('app');

if (rootElement) {
    const root = ReactDom.createRoot(rootElement);
    root.render(<App/>);
} else {
    console.error("Root element #app not found.");
}
