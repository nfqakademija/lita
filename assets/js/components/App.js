import React from "react";
import {
    BrowserRouter as Router,
    Switch,
    Route,
} from "react-router-dom";
import Home from "./Home";
import AcademyInfo from "./AcademyInfo";

export default function App() {
    return (
        <Router>
            <Switch>
                <Route path="/" exact>
                    <Home />
                </Route>
                <Route path="/:academyId">
                    <AcademyInfo />
                </Route>
            </Switch>
        </Router>
    );
}