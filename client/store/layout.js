
export const state = ()=>({
	visibleTeamSettingsModal:false,
	visibleCreateChannel:false,
	isLoading:false,
	isLunchPopoverOverlay: false
})

export const mutations={
	TEAM_SETTINGS(state){
		state.visibleTeamSettingsModal = ! state.visibleTeamSettingsModal
	},
	CREATE_CHANNEL_MODAL(state){
		state.visibleCreateChannel = ! state.visibleCreateChannel
	},
	LOADING_TEAM(state){
		state.isLoading = true
	},
	LOADING_TEAM_FALSE(state){
		state.isLoading = false
	},
	POPOVER_OVERLAY_FALSE(state){
		state.isLunchPopoverOverlay = false
	},
	POPOVER_OVERLAY_TRUE(state){
		state.isLunchPopoverOverlay = true
	}
}