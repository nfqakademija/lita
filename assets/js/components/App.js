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
                <Route path="/:academyId(\d+)">
                    <AcademyInfo />
                </Route>
                <Route><Home /></Route>
            </Switch>
        </Router>
    );
}