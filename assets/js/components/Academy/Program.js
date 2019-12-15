import React, {Fragment, PureComponent} from 'react';
import './academy.scss';
import PropTypes from "prop-types";
import {Link} from "react-router-dom";

class Program extends PureComponent {
    renderProgramPriceBadge = () => {
        const { program } = this.props;
        let badgeColor = 'primary';

        if (program.program_price === 0) badgeColor = 'success';
        else if (program.program_price === null) badgeColor = 'info';

        return (<span className={`badge badge-${badgeColor}`}>{program.program_price}</span>)
    };

    render() {
        const { program, open } = this.props;
        return (
            <Fragment>
                <div className="col-md-2 pl-0">
                    <ul className="list-group" >
                        <li className="list-group-item bg-light">
                            <a
                                href={`#tab${program.program_id}`}
                                data-toggle="tab"
                            >
                                {program.program_name}
                            </a>
                        </li>
                    </ul>
                </div>

                <div className="col-md-10 pl-5">
                    <div
                        id={`tab${program.program_id}`}
                        className={`tab-pane ${open ? 'active' : ''}`}
                    >
                        <div className="row justify-content-between h-100">
                            <div className="col-md-8 pr-0">
                                <h3>{program.program_name}</h3>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                    Nam viverra euismod odio, gravida pellentesque urna varius vitae.
                                    Sed dui lorem, adipiscing in adipiscing et, interdum nec metus.
                                    Mauris ultricies, justo eu convallis placerat, felis enim.
                                </p>
                            </div>

                            <div className="col-md-3 pr-0">
                                <h3 className="">Project Details</h3>
                                <ul>
                                    <li><h4>Kaina: {this.renderProgramPriceBadge()}</h4></li>
                                    <li>Duration: 160h</li>
                                    <li>Vilnius, Kaunas, Klaipeda</li>
                                    <li>Online</li>
                                </ul>
                            </div>

                            <div className="col-md-9">
                                <h3 className="mb-5">Cities & Date</h3>
                                <div id="accordion">
                                    <div className="card">
                                        <div className="card-header the-blue" id="headingOne">
                                            <h5 className="mb-0">
                                                <button className="btn btn-link collapsed" data-toggle="collapse"
                                                        data-target="#collapseOne" aria-expanded="false"
                                                        aria-controls="collapseOne">
                                                    Vilnius
                                                </button>
                                            </h5>
                                        </div>
                                        <div id="collapseOne" className="collapse" aria-labelledby="headingOne"
                                             data-parent="#accordion">
                                            <div className="card-body">
                                                <p>gruodžio 4 d. – vasario 14 d.</p>
                                                <p>gruodžio 4 d. – vasario 14 d.</p>
                                                <p>gruodžio 4 d. – vasario 14 d.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div className="card">
                                        <div className="card-header the-blue" id="headingTwo">
                                            <h5 className="mb-0">
                                                <button className="btn btn-link collapsed" data-toggle="collapse"
                                                        data-target="#collapseTwo" aria-expanded="false"
                                                        aria-controls="collapseTwo">
                                                    Kaunas
                                                </button>
                                            </h5>
                                        </div>
                                        <div id="collapseTwo" className="collapse" aria-labelledby="headingTwo"
                                             data-parent="#accordion">
                                            <div className="card-body">
                                                <p>gruodžio 4 d. – vasario 14 d.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div className="card">
                                        <div className="card-header the-blue" id="headingThree">
                                            <h5 className="mb-0">
                                                <button className="btn btn-link collapsed" data-toggle="collapse"
                                                        data-target="#collapseThree" aria-expanded="false"
                                                        aria-controls="collapseThree">
                                                    Klaipėda
                                                </button>
                                            </h5>
                                        </div>
                                        <div id="collapseThree" className="collapse" aria-labelledby="headingThree"
                                             data-parent="#accordion">
                                            <div className="card-body">
                                                <p>gruodžio 4 d. – vasario 14 d.</p>
                                                <p>gruodžio 4 d. – vasario 14 d.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div className="col-md-9">
                                <div className="reviews">
                                    <h3 className="mt-5">Rate & Review</h3>

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
                                    //href={academyInfo.academy_url}
                                    className="btn btn-primary"
                                >
                                    Eiti į akademijos puslapį
                                </a>
                            </div>


                        </div>
                    </div>
                </div>
            </Fragment>
        );
    }
}

Program.propTypes = {
    program: PropTypes.object,
    open: PropTypes.bool
};

export default Program;
