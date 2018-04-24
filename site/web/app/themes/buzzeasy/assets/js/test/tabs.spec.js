import $ from 'jquery';
import chai, { expect } from 'chai';
import chaiJquery from 'chai-jquery';
import Tabs from 'lib/tabs';

// Chai Jquery for assertions
// https://github.com/chaijs/chai-jquery
chaiJquery(chai, chai.util, $);


let $testTarget = $('body').append("<div id='test-target'></div>");

// Create Instance
function createTabs(overides) {
    // FIXTURE
    const tabsDOM = '<div class="js-tabs"><section class="tabs-container"><h3 class="tabs-container__title vh">Test Tab One</h3><div id="test-tab-one" class="tabs-container__panel">Tab one content in here</div></section><section class="tabs-container"><h3 class="tabs-container__title vh">Test Tab Two</h3><div id="test-tab-two" class="tabs-container__panel">Tab two content in here</div></section></div>';

    const settings = Object.assign({}, {
        options: {},
        dom: $(tabsDOM) // create a new DOM each time otherwise it will be persisted between tests
    }, overides);

    $testTarget.html(settings.dom);

    const el = $('.js-tabs');
    
    return new Tabs(el, settings.options);
}


afterEach(function () {
    $testTarget.html('').empty();
});


describe('Tabs Module', function() {

    describe('Init test', function() {

        it('should use default options if user does not provide overides', function () {
            const tabsInstance = createTabs();
            
            expect(tabsInstance.options).to.deep.equals({
                autoScrollOnPopState: true,
                autoScrollOnLoad: true,
                autoScrollTarget: false,
                updateHistory: true,
                default_tab: 0,                          
                tab_class_panel: ".tabs-container__panel", 
                tab_class_title: ".tabs-container__title",
                tab_nav_id: "TabNav"   
            });
        });

        it('should extend defaults with user provided options ', function () {
            const tabsInstance = createTabs({
                options: {
                    tab_class_panel: ".ALT__tabs-container__ALT"
                }
            });
            
            expect(tabsInstance.options).to.deep.equals({
                autoScrollOnPopState: true,
                autoScrollOnLoad: true,
                autoScrollTarget: false,
                updateHistory: true,
                default_tab: 0,                          
                tab_class_panel: ".ALT__tabs-container__ALT",
                tab_class_title: ".tabs-container__title",
                tab_nav_id: "TabNav"          
            });
        });
    });

    describe('DOM tests', function() {

        it('should add init class to container element', function () {
            const tabsInstance = createTabs();
            expect($('.js-tabs')).to.have.class('tabs-init');
        });

        it('should match the correct number of tab panels in the DOM', function () {

            const theTabsDOM = $('<div class="js-tabs"><section class="tabs-container"><h3 class="tabs-container__title vh">Test Tab One</h3><div id="test-tab-one" class="tabs-container__panel">Tab one content in here</div></section></div>');

            const tabsInstance = createTabs({
                dom: theTabsDOM
            });

            expect(tabsInstance.$tab_panels).to.have.lengthOf(1);
        });


        it('should find the correct initial tab based on options', function () {
            const tabsInstance = createTabs({
                options: {
                    default_tab: 1,       
                }
            });

            expect(tabsInstance.currentTab.$tab_panel).to.have.text('Tab two content in here');
        });


        describe('Panel attributes', function() {
            it('should set correct tab panel attributes', function() {
                const tabsInstance = createTabs();

                const firstPanel  = tabsInstance.$tab_panels.eq(0);
                const secondPanel = tabsInstance.$tab_panels.eq(1);

                // First panel should be visible
                expect(firstPanel).to.have.attr("aria-hidden", "false");


                
                // Second panel should be hidden and have correct attrs
                expect(secondPanel).to.have.attr("aria-hidden", "true");                
                expect(secondPanel).to.have.attr("role", "tabpanel");
                expect(secondPanel).not.to.have.attr('tabindex');
            });

            it('should set correct panel title attributes', function() {
                const tabsInstance = createTabs();

                const panelTitles = $('.js-tabs').find('.tabs-container__title');

                const firstPanelTitle  = panelTitles.eq(0);
                const secondPanelTitle = panelTitles.eq(1);

                // Active Tab
                expect(firstPanelTitle).to.have.attr("role", "tab");    
                expect(firstPanelTitle).to.have.attr("tabindex", "0");    
                expect(firstPanelTitle).to.have.attr("aria-selected", "true");     
                expect(firstPanelTitle).to.have.attr("aria-expanded", "true");        

                // Inactive Tab
                expect(secondPanelTitle).to.have.attr("role", "tab");    
                expect(secondPanelTitle).to.have.attr("tabindex", "-1");    
                expect(secondPanelTitle).to.have.attr("aria-selected", "false");     
                expect(secondPanelTitle).to.have.attr("aria-expanded", "false");        


            });

            it('should correctly match panel title with correct tab panel', function() {
                const tabsInstance = createTabs();

                const firstPanelTitle = $('.js-tabs').find('.tabs-container__title').eq(0);
                const firstPanelID    = tabsInstance.$tab_panels.eq(0).attr('id');

                expect(firstPanelTitle).to.have.attr("aria-controls", firstPanelID);        
            });
        });

        describe('Tab Navigation', function() {
            it('should create the Tab navigation and correct number of items', function() {
                const tabsInstance = createTabs();

                const tabs              = $('.js-tabs');
                const tabNav            = tabs.find('.tabs__navigation');                
                const tabNavItems       = tabNav.find('li');

                expect(tabNav).should.exist; 
                expect(tabs).to.have.class('tabs-nav-init'); // indicate the tabs have been create
                expect(tabNavItems).to.have.lengthOf(2);               
            });

            it('should set the correct Tab navigation attributes', function() {
                const tabsInstance = createTabs();

                const tabNav            = $('.js-tabs').find('.tabs__navigation');     
                const tabNavItems       = tabNav.find('li > a');          
                const firstTabNavItem   = tabNavItems.eq(0);
                const secondTabNavItem  = tabNavItems.eq(1);

                // Ensure it's a tablist
                expect(tabNav).to.have.attr("role", "tablist");     

                // Active Nav Item
                expect( firstTabNavItem ).to.have.attr("role", "tab");    
                expect( firstTabNavItem ).to.have.attr("tabindex", "0");      
                expect( firstTabNavItem ).to.have.attr("aria-selected", "true");  
                expect( firstTabNavItem ).to.have.attr("aria-expanded", "true");  


                // Inactive Nav Items
                expect( secondTabNavItem ).to.have.attr("tabindex", "-1");     
                expect( secondTabNavItem ).to.have.attr("aria-selected", "false");  
                expect( secondTabNavItem ).to.have.attr("aria-expanded", "false");  
                               
            });

            it('should match the tab nav item to the corresponding tab panel', function() {
                const tabsInstance = createTabs();

                const tabNav            = $('.js-tabs').find('.tabs__navigation');     
                const firstTabNavItem   = tabNav.find('li > a').eq(0);          

                const firstPanelID      = tabsInstance.$tab_panels.eq(0).attr('id');

                // Matches Panel ID
                expect( firstTabNavItem ).to.have.attr("aria-controls", firstPanelID);     
            });
        });


        describe('Selecting Tabs', function() {
            it('should open selected tab`s panel and nav item should be active', function() {
                const tabsInstance = createTabs();

                const secondTabPanel    = tabsInstance.$tab_panels.eq(1);

                const secondTabNavItem  = tabsInstance.$tabNavItems.eq(1);

                // Select the new tab
                secondTabNavItem.trigger('click');                
  
                expect( secondTabNavItem ).to.have.attr("tabindex", "0");      
                expect( secondTabNavItem ).to.have.attr("aria-selected", "true");  
                expect( secondTabNavItem ).to.have.attr("aria-expanded", "true");  

                expect( secondTabPanel ).to.have.attr("aria-hidden", "false");
                expect( secondTabPanel ).to.have.attr("tabindex", "0"); 
            });
        });


                    
    });

 
});