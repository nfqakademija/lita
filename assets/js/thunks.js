import { getAcademies, getTypeOptions as getTypes, getCityOptions as getCities, filterAcademies as filter } from "./services/api";
import {setAcademies, setFilteredAcademies} from "./actions/academies";
import {setCityOptions, setTypeOptions,} from "./actions/filters";


export const getAllAcademies = () => (dispatch) => {
    return getAcademies()
        .then((academies) => {
            dispatch(setAcademies(academies));
        });
};

export const getTypeOptions = () => (dispatch) => {
    return getTypes()
        .then((options) => {
            dispatch(setTypeOptions(options));
        });
};

export const getCityOptions = () => (dispatch) => {
    return getCities()
        .then((options) => {
            dispatch(setCityOptions(options));
        });
};

export const filterAcademies = () => (dispatch, getState) => {
    const { filters } = getState();
    return filter(filters.selectedCity, filters.selectedType, filters.selectedPrice)
        .then((academies) => {
            dispatch(setFilteredAcademies(academies.length === 0 ? 'Empty' : academies));
        });
};