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
            <div className="container">
                <div className="align-items-center justify-content-between h-100">
                    <div className="row align-items-center justify-content-between h-100">
                        <h1 className="my-4">{academyInfo.academy_name}</h1>
                        <span className="text-warning">★ ★ ★ ★ ☆</span>
                    </div>
                    <div className="row align-items-center justify-content-between h-100">

                        <div className="col-md-3 pl-0">
                            <img className="img-fluid" src="http://placehold.it/500x300" alt=""/>
                        </div>

                        <div className="col-md-5">
                            <h3 className="">Project Description</h3>
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
                    <h3 className="my-4">Programs</h3>

                    <div className="d-flex" id="wrapper">
                        <ul className="list-group list-group-flush">
                            <li className="list-group-item list-group-item-action bg-light active">
                                <a href="#tab1" data-toggle="tab">Dashboard</a>
                            </li>
                            <li className="list-group-item list-group-item-action bg-light">
                                <a href="#tab2" data-toggle="tab">Shortcuts</a>
                            </li>
                            <li className="list-group-item list-group-item-action bg-light">
                                <a href="#tab3" data-toggle="tab">Overview</a>
                            </li>
                            <li className="list-group-item list-group-item-action bg-light">
                                <a href="#tab4" data-toggle="tab">Events</a>
                            </li>
                            <li className="list-group-item list-group-item-action bg-light">
                                <a href="#tab5" data-toggle="tab">Profile</a>
                            </li>
                            <li className="list-group-item list-group-item-action bg-light">
                                <a href="#tab6" data-toggle="tab">Status</a>
                            </li>
                        </ul>

                        <div className="container-fluid pl-5">
                            <div className="tab-pane active" id="tab1">
                                <div className="row align-items-center justify-content-between h-100">
                                    <div className="col-md-8">
                                        <h3 className="">Project Description</h3>
                                        <p>
                                            {academyInfo.academy_programs && academyInfo.academy_programs.length > 0
                                            ? <Programs programs={academyInfo.academy_programs}/>
                                            : 'Akademija kol kas neturi programų.'
                                            }
                                        </p>
                                    </div>
                                    <div className="col-md-3 pr-0">
                                        <h3 className="">Project Details</h3>
                                        <ul>
                                            <li>Price: from 459e</li>
                                            <li>Duration: 160h</li>
                                            <li>Vilnius, Kaunas, Klaipeda</li>
                                            <li>Online</li>
                                        </ul>
                                    </div>


                                    <div className="col-md-9">
                                        <div className="reviews">
                                            <div className="title mt-5">Rate & Review</div>

                                        </div>
                                    </div>
                                    <div className="">
                                        <Link
                                            to="/"
                                            type="button"
                                            rel="noreferrer noopener"
                                            className="btn btn-secondary"
                                        >
                                            Grįžti
                                        </Link>
                                        <a
                                            type="button"
                                            rel="noreferrer noopener"
                                            target="_blank"
                                            href={academyInfo.academy_url}
                                            className="btn btn-primary"
                                        >
                                            Eiti į akademijos puslapį
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
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
