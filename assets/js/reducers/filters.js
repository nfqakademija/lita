const initialStateOfFilters = {
    cityOptions: [],
    typeOptions: [],
    selectedCity: null,
    selectedType: null,
    freePrice: false,
};

const filters = (state = initialStateOfFilters, action) => {
    switch (action.type) {
        case 'setCityOptions': return {
            ...state,
            cityOptions: action.cityOptions,
        };
        case 'setTypeOptions': return {
            ...state,
            typeOptions: action.typeOptions,
        };
        case 'setSelectedCity': return {
            ...state,
            selectedCity: action.selectedCity,
        };
        case 'setSelectedType': return {
            ...state,
            selectedType: action.selectedType,
        };
        case 'setFreePrice': return {
            ...state,
            freePrice: action.freePrice,
        };
        default: return state;
    }
};

export default filters;
