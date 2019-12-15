import React, {Component, Fragment } from 'react';
import { withRouter } from 'react-router-dom';
import Dropdown from "react-bootstrap/Dropdown";
import Form from 'react-bootstrap/Form'
import './filters.scss';
import PropTypes from "prop-types";
import { filterAcademies, getTypeOptions, getCityOptions } from "../../thunks";
import { setSelectedCity, setCityOptions, setPrice, setSelectedType } from "../../actions/filters";
import {connect} from "react-redux";

class Filters extends Component {
    componentDidMount() {
        const { getTypeOptions, getCityOptions, cityOptions, typeOptions } = this.props;

        if (cityOptions.length === 0)  getCityOptions();
        if (typeOptions.length === 0)  getTypeOptions();
        this.resolveLocation();
        this.props.filterAcademies();
    }

    resolveLocation = () => {
        if (location.search !== '') {
            const searchParams = new URLSearchParams(location.search);
            this.props.setSelectedCity(searchParams.get('City'));
            this.props.setSelectedType(searchParams.get('Program'));
            this.props.setPrice(searchParams.get('Price'));
        }
    };

    selectCity = (key, event) => {
        const searchParams = new URLSearchParams(location.search);

        if (event.currentTarget.innerText === 'Visi') {
            searchParams.delete('City');
            this.props.setSelectedCity(null);
        } else {
            searchParams.delete('City');
            searchParams.append('City', event.currentTarget.innerText);
            this.props.setSelectedCity(event.currentTarget.innerText);
        }

        this.props.history.push(`${location.pathname}?${searchParams.toString()}`);
    };

    selectType = (key, event) => {
        const searchParams = new URLSearchParams(location.search);

        if (event.currentTarget.innerText === 'Visos') {
            searchParams.delete('Program');
            this.props.setSelectedType(null);
        } else {
            searchParams.delete('Program');
            searchParams.append('Program', event.currentTarget.innerText);
            this.props.setSelectedType(event.currentTarget.innerText);
        }

        this.props.history.push(`${location.pathname}?${searchParams.toString()}`);
    };

    setPriceSort = (event) => {
        const searchParams = new URLSearchParams(location.search);
        searchParams.delete('Price');
        searchParams.append('Price', event.currentTarget.labels[0].innerText);
        this.props.history.push(`${location.pathname}?${searchParams.toString()}`);

        this.props.setPrice(event.currentTarget.labels[0].innerText);
        this.props.filterAcademies();
    };

    render() {
        return (
            <Fragment>
                <div className="row pt-5">
                    <label className="col-lg-2 col-12 filter-label">Filtruoti pagal:</label>
                    <div className="col-lg-8 col-12 mb-3">
                        <div className="row">
                            <div className="col-12 col-lg-6 mb-3 dropdown filter my-lg-auto">
                                <Dropdown>
                                    <Dropdown.Toggle variant="primary" id="dropdown-basic" className="filter-toggle">
                                        { this.props.selectedCity === null ? "Miestas" : this.props.selectedCity }
                                    </Dropdown.Toggle>

                                    <Dropdown.Menu>
                                        <Dropdown.Item onSelect={this.selectCity}>Visi</Dropdown.Item>
                                        {this.props.cityOptions.map(city => (
                                            <Dropdown.Item key={city} onSelect={this.selectCity}>{ city }</Dropdown.Item>
                                        ))}
                                    </Dropdown.Menu>
                                </Dropdown>
                            </div>
                            <div className="col-12 col-lg-6 mb-3 dropdown filter my-lg-auto">
                                <Dropdown>
                                    <Dropdown.Toggle variant="primary" id="dropdown-basic" className="filter-toggle">
                                        { this.props.selectedType === null ? "Programa" : this.props.selectedType }
                                    </Dropdown.Toggle>

                                    <Dropdown.Menu>
                                        <Dropdown.Item onSelect={this.selectType}>Visos</Dropdown.Item>
                                        {this.props.typeOptions.map(type => (
                                            <Dropdown.Item key={type} onSelect={this.selectType}>{ type }</Dropdown.Item>
                                        ))}
                                    </Dropdown.Menu>
                                </Dropdown>
                            </div>
                        </div>
                    </div>
                    <div className="col-lg-2 col-12 mb-3">
                        <button className="btn btn-blue ml-auto w-100" onClick={this.props.filterAcademies}>Filtruoti</button>
                    </div>
                </div>
                <div className="row">
                    <Form className="col-12">
                        <div className="mb-3">
                            <Form.Check
                                custom
                                onChange={this.setPriceSort}
                                inline
                                label="Pigiausios viršuje"
                                type="radio"
                                name="sort"
                                checked={this.props.price === 'Pigiausios viršuje'}
                                id="cheap"
                            />
                            <Form.Check
                                custom
                                onChange={this.setPriceSort}
                                inline
                                label="Brangiausios viršuje"
                                type="radio"
                                name="sort"
                                checked={this.props.price === 'Brangiausios viršuje'}
                                id="expensive"
                            />
                            <Form.Check
                                custom
                                onChange={this.setPriceSort}
                                inline
                                label="Nemokamos"
                                type="radio"
                                name="sort"
                                checked={this.props.price === 'Nemokamos'}
                                id="free"
                            />
                        </div>
                    </Form>
                </div>
            </Fragment>

        );
    }
}


Filters.propTypes = {
    cityOptions: PropTypes.array,
    typeOptions: PropTypes.array,
    selectedCity: PropTypes.any,
    selectedType: PropTypes.any,
    price: PropTypes.string,
    getCityOptions: PropTypes.func,
    getTypeOptions: PropTypes.func,
    filterAcademies: PropTypes.func,
    setSelectedCity: PropTypes.func,
    setSelectedType: PropTypes.func,
    setPrice: PropTypes.func,
    history: PropTypes.object,
}

const mapStateToProps = (state) => ({
    cityOptions: state.filters.cityOptions,
    typeOptions: state.filters.typeOptions,
    selectedCity: state.filters.selectedCity,
    selectedType: state.filters.selectedType,
    price: state.filters.selectedPrice,
});
const mapDispatchToProps = (dispatch) => ({
    filterAcademies: () => dispatch(filterAcademies()),
    getCityOptions: () => dispatch(getCityOptions()),
    getTypeOptions: () => dispatch(getTypeOptions()),
    setCityOptions: () => dispatch(setCityOptions()),
    setSelectedCity: (city) => dispatch(setSelectedCity(city)),
    setSelectedType: (type) => dispatch(setSelectedType(type)),
    setPrice: (value) => dispatch(setPrice(value)),
});

export default connect(
    mapStateToProps,
    mapDispatchToProps,
)(withRouter(Filters));
