import React, { Component } from 'react';
import './academy.scss';
import PropTypes from "prop-types";
import Programs from "./Programs";

class Academy extends Component {
    render() {
        const { cleanAcademyInfo, academyInfo } = this.props;

        return (
            <div
                className={`modal bd-example-modal-lg show ${academyInfo !== false ? 'modal-wrapper' : ''}`}
                tabIndex="-1"
                role="dialog"
            >
                <div className="modal-dialog modal-lg academy-modal" role="document">
                    <div className="modal-content">
                        <div className="modal-header">
                            <div className="media">
                                <img className="mr-3 academy-modal__logo"
                                     src={academyInfo.academy_logo}
                                     alt="Generic placeholder image"
                                />
                                    <div className="media-body">
                                        <h5 className="mt-0 modal-title">{academyInfo.academy_name}</h5>
                                        <small className="mr-3">{academyInfo.academy_email}</small>
                                        <small>{academyInfo.academy_url}</small>
                                        <p>
                                            {academyInfo.academy_description}
                                        </p>
                                    </div>
                            </div>
                            <button type="button" className="close" data-dismiss="modal" aria-label="Close" onClick={cleanAcademyInfo}>
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div className="modal-body">
                            {academyInfo.academy_programs && academyInfo.academy_programs.length > 0
                                ? <Programs programs={academyInfo.academy_programs}/>
                                : 'Akademija kol kas neturi programų.'
                            }
                        </div>
                        <div className="modal-footer">
                            <button
                                type="button"
                                className="btn btn-secondary"
                                onClick={cleanAcademyInfo}
                            >
                                Uždaryti
                            </button>
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
        );
    }
}

Academy.propTypes = {
    academyInfo: PropTypes.oneOfType([
        PropTypes.bool,
        PropTypes.shape({
            academy_logo: PropTypes.string,
            academy_programs: PropTypes.array
        })
    ]).isRequired,
    cleanAcademyInfo: PropTypes.func.isRequired
};

export default Academy;
