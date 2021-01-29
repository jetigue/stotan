<div class="font-semibold text-green-500">
    @if($message === 'created')
        <span
            x-data="{show: true}"
            x-init="
                setTimeout(() => { show = false }, 2500)
                setTimeout(() => { $refs.this.remove() }, 3500)
            "
            x-show.transition.duration.1000ms="show"
            x-ref="this"
            >Run Created!
        </span>
    @elseif ($message === 'saved')
        <span
            x-data="{show: true}"
            x-init="
                setTimeout(() => { show = false }, 2500)
                setTimeout(() => { $refs.this.remove() }, 3500)
            "
            x-show.transition.duration.1000ms="show"
            x-ref="this"
            >Run Saved!
        </span>
    @elseif ($message === 'deleted')
        <span
            x-data="{show: true}"
            x-init="
                setTimeout(() => { show = false }, 2500)
                setTimeout(() => { $refs.this.remove() }, 3500)
            "
            x-show.transition.duration.1000ms="show"
            x-ref="this"
            >Run Deleted!
        </span>
    @endif
</div>
