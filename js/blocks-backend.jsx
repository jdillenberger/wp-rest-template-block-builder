const {
    registerBlockType
} = wp.blocks


document.addEventListener('DOMContentLoaded', function() {

const blockName = 'rest-template-block'
const blockTitle = 'REST Template Block'
const blockDescr = 'A block that does basically nothing'
const blockIcon = 'text'
const blockCategory = 'layout'
const blockAttributes = {
    id: {
        type: Number
    }
}

registerBlockType(`rest-template-block-builder/${blockName}`, {
    title: blockTitle,
    description: blockDescr,
    icon: blockIcon,
    category: blockCategory,
    attributes: blockAttributes,
    edit:  ( { attributes, setAttributes } ) => {

        const updateAttribute = (event) => {
            setAttributes( { id: event.target.value} )
        }

        return <div style={{padding: '1rem'}}>
                    <h3>REST Template Block</h3>
                    <select style={{minWidth: '30rem'}} onChange={ updateAttribute } value={ attributes.id } >
                        
                        {[undefined, ...blocks].map((block, index) => {
                            if (block == undefined) {
                                return <option selected disabled value={block} style={{textAlign: 'center'}}> -- Select REST-Block -- </option>
                            }
                            return <option selected={index==0} value={block.id}>{block.id} - {block.title}</option>
                        })}
                    </select>
                </div>


    },
    save: ( { attributes } ) => {
        return <div class="rest-blocks-frontend" id={ `rest-blocks-frontend-${attributes.id}` }><rest-template-block block-id={attributes.id} /></div>
    }
})

})

