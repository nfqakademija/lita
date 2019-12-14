import React, {Fragment, PureComponent} from 'react';
import Dropdown from "react-bootstrap/Dropdown";
import Form from 'react-bootstrap/Form'
import './filters.scss';
import PropTypes from "prop-types";
import { filterAcademies, getTypeOptions, getCityOptions } from "../../thunks";
import { setSelectedCity, setCityOptions, setFreePrice, setSelectedType } from "../../actions/filters";
import {connect} from "react-redux";

class Filters extends PureComponent {
    componentDidMount() {
        const { getTypeOptions, getCityOptions, cityOptions, typeOptions } = this.props;

        if (cityOptions.length === 0)  getCityOptions();
        if (typeOptions.length === 0)  getTypeOptions();
    }

    selectCity = (key, event) => {
        if (event.currentTarget.innerText === 'Visi') {
            this.props.setSelectedCity(null);
        } else {
            this.props.setSelectedCity(event.currentTarget.innerText);
        }
    };

    selectType = (key, event) => {
        if (event.currentTarget.innerText === 'Visos') {
            this.props.setSelectedType(null);
        } else {
            this.props.setSelectedType(event.currentTarget.innerText);
        }
    };

    priceCheck = (event) => {
        this.props.setFreePrice(event.currentTarget.checked);
    };

    setSort = (event) => {
        //this.props.setFreePrice(event.currentTarget.labels[0].innerText);
        this.props.filterAcademies();
    };

    render() {
        return (
            <Fragment>
                <div className="row pt-5">
                    <label className="col-lg-2 col-12 filter-label">Filtruoti pagal:</label>
                    <div className="col-lg-8 col-12 mb-3">
                        <div className="row">
                            <div className="col-12 col-lg-4 mb-3 dropdown filter my-lg-auto">
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
                            <div className="col-12 col-lg-4 mb-3 dropdown filter my-lg-auto">
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
                            <div className="col-12 col-lg-4 mb-3 dropdown filter my-lg-auto text-center">
                                <div className="form-check">
                                    <input type="checkbox" className="form-check-input" id="price" defaultChecked={this.props.freePrice} onClick={this.priceCheck}/>
                                    <label className="form-check-label" htmlFor="price">Nemokamos</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div className="col-lg-2 col-12 mb-3">
                        <button className="btn btn-blue ml-auto w-100" onClick={this.props.filterAcademies}>Filtruoti</button>
                    </div>
                </div>
                <div className="row">
                    <Form>
                        <div className="mb-3">
                            <Form.Check
                                custom
                                onChange={this.setSort}
                                inline
                                label="Pigiausios viršuje"
                                type="radio"
                                name="sort"
                                defaultChecked={this.props.freePrice}
                                id="cheap"
                            />
                            <Form.Check
                                custom
                                onChange={this.setSort}
                                inline
                                label="Brangiausios viršuje"
                                type="radio"
                                name="sort"
                                id="expensive"
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
    freePrice: PropTypes.bool,
    getCityOptions: PropTypes.func,
    getTypeOptions: PropTypes.func,
    filterAcademies: PropTypes.func,
    setSelectedCity: PropTypes.func,
    setSelectedType: PropTypes.func,
    setFreePrice: PropTypes.func,
}

const mapStateToProps = (state) => ({
    cityOptions: state.filters.cityOptions,
    typeOptions: state.filters.typeOptions,
    selectedCity: state.filters.selectedCity,
    selectedType: state.filters.selectedType,
    freePrice: state.filters.freePrice,
});
const mapDispatchToProps = (dispatch) => ({
    filterAcademies: () => dispatch(filterAcademies()),
    getCityOptions: () => dispatch(getCityOptions()),
    getTypeOptions: () => dispatch(getTypeOptions()),
    setCityOptions: () => dispatch(setCityOptions()),
    setSelectedCity: (city) => dispatch(setSelectedCity(city)),
    setSelectedType: (type) => dispatch(setSelectedType(type)),
    setFreePrice: (value) => dispatch(setFreePrice(value)),
});

export default connect(
    mapStateToProps,
    mapDispatchToProps,
)(Filters);
