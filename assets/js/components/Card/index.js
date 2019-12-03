import React, { PureComponent } from 'react';
import './card.scss';
import PropTypes from "prop-types";

class Card extends PureComponent {
    render() {
        const { academy } = this.props;
        return (
            <div className="card promoting-card flex-wrap flex-row academy-card academy-card--shadow">
                    <div className="col-lg-8 card-body d-flex flex-row p-3">
                        <img src={academy.academy_logo} className="logo rounded-circle mr-3" alt={academy.academy_name} />
                        <div>
                            <h5 className="card-title font-weight-bold mb-2">{academy.academy_name}</h5>
                            <p className="card-text"><i className="fa fa-calendar pr-2" aria-hidden="true" />2019-11-14</p>
                            <p className="card-text">{academy.description ? academy.description : 'Labai puiki akademija, turi daug įvairių programų'}</p>
                        </div>


                    </div>
                    <div className="col-lg-4 p-3 d-flex flex-column justify-content-between card-right">
                        <div className="row">
                            <div className="col-5">
                                <i className="fa fa-eur pr-1" aria-hidden="true" /><span className="price">{academy.price ? academy.price : 'Nemokama'}</span>
                            </div>
                            <div className="col-4">
                                <i className="fa fa-clock-o pr-1" aria-hidden="true" />3 mėn
                            </div>
                            <div className="col-3">
                                <i className="fa fa-map-marker  pr-1" aria-hidden="true" />Vilnius
                            </div>
                        </div>
                        <div className="d-flex flex-column align-items-end">
                            <div className="mt-4 mb-5">
                                <a href={academy.academy_url} className="card-link">{academy.academy_url}</a>
                            </div>
                            <button className="btn btn-blue">Skaityti daugiau</button>
                        </div>
                </div>
            </div>
        );
    }
}

Card.propTypes = {
    academy: PropTypes.shape({
        academy_logo: PropTypes.string,
        academy_name: PropTypes.string,
        description: PropTypes.string,
        academy_email: PropTypes.string,
        price: PropTypes.oneOfType([PropTypes.string, PropTypes.bool]),
        academy_url: PropTypes.string,
    })
};


export default Card;
