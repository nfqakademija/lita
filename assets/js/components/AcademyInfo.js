import React, { Component } from 'react';
import { Link, withRouter } from 'react-router-dom'
import { getExtendedAcademyInfo } from "../services/api";
import Programs from "./Academy/Programs";
import PropTypes from "prop-types";
import Academy from "./Academy";

class AcademyInfo extends Component {
    state = {
        extendedAcademyInfo: {}
    };

    async componentDidMount() {
        const { match: { params: { academyId } } } = this.props;
        const extendedAcademyInfo = await getExtendedAcademyInfo(academyId);
        this.setState({ extendedAcademyInfo });
    }
    render() {
        const { extendedAcademyInfo: academyInfo } = this.state;
        return (
            <div className="container-fluid px-lg-5 px-sm-3">
                <div className="align-items-center justify-content-between h-100">
                    <div className="row align-items-center justify-content-between h-100">
                        <h1 className="my-4">{academyInfo.academy_name}</h1>
                        <span className="text-warning">★ ★ ★ ★ ☆</span>
                    </div>
                    <div className="row align-items-center justify-content-between h-100">

                        <div className="col-md-1 pl-0">
                            <img
                                className="img-fluid"
                                src={academyInfo.academy_logo}
                                alt="Generic placeholder image"/>
                        </div>

                        <div className="col-md-8">
                            <p>{academyInfo.academy_description}</p>
                        </div>
                        <div className="col-md-3 pr-0">
                            <h3 className="">Project Details</h3>
                            <ul>
                                <li>{academyInfo.academy_email}</li>
                                <li>{academyInfo.academy_url}</li>
                                <li>Vilnius, Kaunas, Klaipeda</li>
                                <li>Online</li>
                            </ul>
                        </div>

                    </div>
                    <h3 className="my-4">Programos</h3>

                    <div className="d-flex">
                        {academyInfo.academy_programs && academyInfo.academy_programs.length > 0
                            ? <Programs programs={academyInfo.academy_programs}/>
                            : 'Akademija kol kas neturi programų.'
                        }
                    </div>
                </div>
            </div>
        );
    }
}

AcademyInfo.propTypes = {
    match: PropTypes.shape({
        params: PropTypes.shape({
            academyId: PropTypes.string
        })
    }).isRequired,
};

export default withRouter(AcademyInfo);
