import './bootstrap';

import React from "react";
import ReactDom from "react-dom/client";

function App() {
    return (
        <div>
            <h1>Test</h1>
        </div>
    )
}
const rootElement = document.getElementById('app');

if (rootElement) {
    const root = ReactDom.createRoot(rootElement);
    root.render(<App />);
} else {
    console.error("Root element #app not found.");
}
