import React, { Component } from 'react';
import { Link, withRouter } from 'react-router-dom'
import { getExtendedAcademyInfo } from "../services/api";
import Programs from "./Academy/Programs";
import PropTypes from "prop-types";
import Academy from "./Academy";

class AcademyInfo extends Component {
    state = {
        extendedAcademyInfo: {},
        programFilter: null
    };

    async componentDidMount() {
        const { match: { params: { academyId } } } = this.props;
        const searchParams = new URLSearchParams(location.search);

        const extendedAcademyInfo = await getExtendedAcademyInfo(academyId);
        this.setState({ extendedAcademyInfo, programFilter: searchParams.get('Program') });
    }
    render() {
        const { extendedAcademyInfo: academyInfo, programFilter } = this.state;
        return (
            <div className="container px-lg-5 px-sm-3">
                <div className="align-items-center justify-content-between h-100">
                    <div className="row text-left pt-3">
                        <nav aria-label="breadcrumb" className="w-100">
                            <ol className="breadcrumb">
                                <li className="breadcrumb-item">
                                    <Link
                                        to={{
                                            pathname: "/",
                                            search: location.search
                                        }}
                                    >
                                        Pagrindinis
                                    </Link>
                                </li>
                                <li className="breadcrumb-item active" aria-current="page">{academyInfo.academy_name}</li>
                            </ol>
                        </nav>
                    </div>
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
                        <div className="col-md-3 pr-0">
                            <h3 className="">Kontaktai</h3>
                            <ul>
                                <li>{academyInfo.academy_email}</li>
                                <li>{academyInfo.academy_url}</li>
                            </ul>
                        </div>

                    </div>
                    <h3 className="my-4">Programos</h3>
                    <div className="d-flex">
                        {academyInfo.academy_programs && academyInfo.academy_programs.length > 0
                            ? <Programs
                                programs={academyInfo.academy_programs}
                                preferableProgram={programFilter === null ? '' : programFilter}
                            />
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
